<?php include "../scripts/permissao.php";include "../conf/config.php";include "../function/pega-nome.php";include "../function/pega-nivel.php";include "../function/format_data.php";include_once "../function/upload-redimensionar.php";?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head>    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    <title>Editar Membros | Sistema de Controle    </title>    <link rel="stylesheet" href="../css/style.css"/>    <script type="text/javascript" src="../js/jquery.js">    </script>    <script type="text/javascript" src="../js/menu.js">    </script>    <script type="text/javascript" src="../js/jmask.js">    </script>    <script type="text/javascript" src="../js/jquery.form.js">    </script>    <script type="text/javascript">        $(function(){            $('#data').mask('99-99-9999');            $('#tel').mask('(99)9999-9999');            $('#cel').mask('(99)9999-9999');            $("form div:first").show().css({"background":"#FFF"});            $(".nav a").click(function(){                $("form div").hide();                var div=$(this).attr('href');                $(div).fadeIn();                return false;            });  /*          $( "#formulario" ).on( "submit", function( event ) {                event.preventDefault();                var data = new FormData();                $.each(files, function(key, value){                    data.append(key, value);                });                $.post(                    "../scripts/edit_membros_ajax.php",                    $("#formulario").serialize(),                    function(dados){                        $(".alertas").html(dados);                        //location.reload();                        return false;                    }                );            });*/            $("#btn-submit").on('click', function(){                event.stopPropagation(); // Stop stuff happening                event.preventDefault(); // Totally stop stuff happening                $('#formulario').ajaxForm({ target:'#visualizar'}).submit(); // o callback será no elemento com o id #visualizar }).submit();            });        });    </script></head><body><div id="box">    <div id="header">    </div><div id="corpo">    <div id="conteudo">    <ul class="nav">        <li><a href="#pessoais" style="border-left:1px solid #333;">Dados Pessoais</a></li>        <li><a href="#familiares" style="border-left:1px solid #333;">Dados Fam&iacute;liares</a></li>        <li><a href="#complementares" style="border-left:1px solid #333;">Dados Complementares</a></li>        <li><a href="#igreja" style="border-left:1px solid #333;border-right:1px solid #333;">Dados Eclesiásticos</a></li>    </ul><div style="clear: both;"></div>    <div class="alertas">    </div>    <form action="../scripts/edit_membros_ajax.php" method="post" id="formulario" enctype="multipart/form-data">        <?php        $id=(int)$_GET['id'];        $sql=mysql_query("SELECT * FROM membros WHERE id='$id' ") or die(mysql_error());        $result=mysql_fetch_array($sql);        ?>    <legend>Editar cadastro de membro</legend>    <fieldset>    <div id="pessoais"><h4>Dados Pessoais</h4><input type="hidden" name="id" value="<?php echo (int)$_GET['id'];?>" />        <span>Foto</span>        <img src="../uploads/<?php echo $result['foto'];?>" />        <span>Caso queira edita-la, insira uma foto abaixo.</span>        <input type="file" name="foto" id="upload_foto"/>    <label>        <span>C&oacute;digo</span>        <input type="text" name="codigo" value="<?php echo $result['id'];?>"/>    </label>    <label>        <span>Nome</span>        <input type="text" value="<?php echo $result['nome'];?>" name="nome" placeholder="Insira o nome"/>    </label>    <label>        <span>Sexo</span>        <select name="sexo">            <option value="" selected="selected">Selecione o sexo</option><?php            if($result['sexo']=='Masculino'){                echo '<option value="Masculino" selected="selected">Masculino</option>                      <option value="Feminino">Feminino</option>';            }else{echo '<option value="Masculino">Masculino</option>                        <option value="Feminino" selected="selected">Feminino</option>';}?>        </select>    </label>    <label><span>Estado-Civil</span>        <select name="EstadoCivil">            <?php if($result['sexo']=='Casado'){                echo '<option value="Casado" selected="selected">Casado</option>                        <option value="Solteiro">Solteiro</option>                        <option value="Viuvo(a)">Viuvo(a)</option>                        <option value="Amasiado(a)">Amasiado(a)</option>                        <option value="Divorciado(a)">Divorciado(a)</option>                        <option value="Outros</select>">Outros</option>                      ';            }else if($result['sexo'] == 'Solteiro'){                echo '<option value="Casado">Casado</option>                        <option value="Solteiro" selected="selected">Solteiro</option>                        <option value="Viuvo(a)">Viuvo(a)</option>                        <option value="Amasiado(a)">Amasiado(a)</option>                        <option value="Divorciado(a)">Divorciado(a)</option>                        <option value="Outros</select>">Outros</option>';            }else if($result['sexo'] == 'Viuvo(a)'){                echo '<option value="Casado">Casado</option>                        <option value="Solteiro">Solteiro</option>                        <option value="Viuvo(a)" selected="selected">Viuvo(a)</option>                        <option value="Amasiado(a)">Amasiado(a)</option>                        <option value="Divorciado(a)">Divorciado(a)</option>                        <option value="Outros</select>">Outros</option>';            }else if($result['sexo'] == 'Amasiado(a)'){                echo '<option value="Casado">Casado</option>                        <option value="Solteiro">Solteiro</option>                        <option value="Viuvo(a)">Viuvo(a)</option>                        <option value="Amasiado(a)" selected="selected">Amasiado(a)</option>                        <option value="Divorciado(a)">Divorciado(a)</option>                        <option value="Outros</select>">Outros</option>';            }else if($result['sexo'] == 'Divorciado(a)'){                echo '<option value="Casado">Casado</option>                        <option value="Solteiro">Solteiro</option>                        <option value="Viuvo(a)">Viuvo(a)</option>                        <option value="Amasiado(a)">Amasiado(a)</option>                        <option value="Divorciado(a)" selected="selected">Divorciado(a)</option>                        <option value="Outros</select>">Outros</option>';            }else if($result['sexo'] == 'Outros)'){                echo '<option value="Casado">Casado</option>                        <option value="Solteiro">Solteiro</option>                        <option value="Viuvo(a)">Viuvo(a)</option>                        <option value="Amasiado(a)">Amasiado(a)</option>                        <option value="Divorciado(a)">Divorciado(a)</option>                        <option value="Outros</select>" selected="selected">Outros</option>';            }else{                echo '  <option value="" selected="selected">Selecione um estado civil</option>                        <option value="Casado">Casado</option>                        <option value="Solteiro">Solteiro</option>                        <option value="Viuvo(a)">Viuvo(a)</option>                        <option value="Amasiado(a)">Amasiado(a)</option>                        <option value="Divorciado(a)">Divorciado(a)</option>                        <option value="Outros</select>">Outros</option>';            }            ?>        </select>    </label>    <label>        <span>Data de Nascimento</span><small>No formato dd-mm-aaaa.</small>        <input type="text" value="<?php echo format_data_Normal($result['dataNascimento']);?>" name="dataNascimento" id="data"/>    </label>    <span>Cidade</span>    <select name="estadoNascimento" id="estadoNascimento" style="margin-bottom:5px;">        <option value="" selected="selected">Selecione estado</option>        <?php $consulta=mysql_query("SELECT DISTINCT uf FROM tb_cidades ORDER BY uf ASC");while(        $ln=mysql_fetch_array($consulta)){            if($result['estadoNascimento']==$ln['uf']){                echo '<option value="'.$ln['uf'].'" selected="selected">'.$ln['uf'].'</option>';            }else{                echo '<option value="'.$ln['uf'].'">'.$ln['uf'].'</option>';            }        }?>    </select>    <script type="text/javascript">        var estado=$("#estadoNascimento").val();        var cidade = <?php echo $result['cidadeNascimento'];?>;        $.post("../scripts/volta-cidade-edit.php",            {estado:estado, cidade:cidade},            function(valor){                $("select[name=cidadeNascimento]").html(valor);            });    </script>    <select name="cidadeNascimento">        <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>    </select>    <label>        <span>Nacionalidade</span>        <input type="text" value="<?php echo $result['nacionalidade'];?>" name="nacionalidade"/>    </label>    <label>        <span>Telefone</span>        <input type="text" value="<?php echo $result['telefone'];?>" name="tel" id="tel"/>    </label>    <label>        <span>Telefone 1</span>        <input type="text" value="<?php echo $result['tel1'];?>" name="tel1" id="tel"/>    </label>    <label>        <span>Telefone 2</span>        <input type="text" value="<?php echo $result['tel2'];?>" name="tel2" id="tel"/>    </label>    <label>        <span>Celular</span>        <input type="text" value="<?php echo $result['celular'];?>" name="celular" id="cel"/>    </label>    <label>        <span>E-Mail</span>        <input type="text" value="<?php echo $result['email'];?>" name="email"/>    </label>    <label>        <span>Skype</span>        <input type="text" value="<?php echo $result['skype'];?>" name="skype"/>    </label>    <label>        <span>Senha nova</span>        <input type="password" name="senhaNova"/>    </label>    <span>Status</span>    <?php        if($result['status'] == 1){            echo '<input type="radio" name="status" value="1" checked="checked" />Ativado                  <input type="radio" name="status" value="0" />Desativado';        }else{            echo '<input type="radio" name="status" value="1"/>Ativado                 <input type="radio" name="status" value="0"  checked="checked"  />Desativado';        }    ?><br />        <input type="hidden" name="acao" value="cadastrar"/>        <button id="btn-submit" class="submitar">Atualizar</button>        <!--<input type="submit" value="Cadastrar" id="btn-submit"/>--></div><div id="familiares">    <h4>Dados Fam&iacute;liares</h4>    <label>        <span>Nome do Pai</span>        <select name="nomePai">            <option value="" selected="selected" disabled="disabled">Selecione o nome do Pai</option><?php $mysql=mysql_query("SELECT * FROM membros ORDER BY nome ASC");while($res=mysql_fetch_array($mysql)){if($result['nomePai']==$res['id']){echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';}else{echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';}}?>       </select>    </label>    <label>        <span>Nome da M&atilde;e</span>        <select name="nomeMae">            <option value="" selected="selected" disabled="disabled">Selecione o nome da Mae</option><?php $mysql=mysql_query("SELECT * FROM membros ORDER BY nome ASC");            while($res=mysql_fetch_array($mysql)){if($result['nomeMae']==$res['id']){                echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';}else{echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';}}?>        </select>    </label>    <label>        <span>Nome do C&ocirc;njuge</span>        <select name="conjuge">            <option value="" selected="selected" disabled="disabled">Selecione o nome do conjuge</option><?php $mysql=mysql_query("SELECT * FROM membros ORDER BY nome ASC");while($res=mysql_fetch_array($mysql)){if($result['conjuge']==$res['id']){echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';}else{echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';}}?>        </select>    </label>    <div id="filhosEstadoCivil">        <span>Tem Filhos?</span>        <?php if($result['filhos']==1){            echo '<input type="radio" name="filhos" value="1" checked="checked"/>Sim<input type="radio" name="filhos" value="0"/>N&atilde;o';}else{echo '<input type="radio" name="filhos" value="1"/>Sim<input type="radio" name="filhos" value="0" checked="checked"/>N&atilde;o';}?>    </div></div><div id="complementares"><h4>Dados Complementares</h4>    <label>        <span>Endere&ccedil;o</span>        <input type="text" value="<?php echo $result['endereco'];?>" name="endereco"/>    </label>    <label>        <span>Bairro</span>        <input type="text" value="<?php echo $result['bairro'];?>" name="bairro"/>    </label>    <label>        <span>Cidade</span>        <select name="estado" id="estado" style="margin-bottom:5px;">        <option value="" selected="selected">Selecione estado</option><?php $consulta=mysql_query("SELECT DISTINCT uf FROM tb_cidades ORDER BY uf ASC");while($ln=mysql_fetch_array($consulta)){echo '        <option value="'.$ln['uf'].'">'.$ln['uf'].'</option>';}?>    </select>    <script type="text/javascript">var estado=$("#estado").val();$.post("../scripts/volta-cidade.php",{estado:estado}, function(valor){$("select[name=cidade]").html(valor);})    </script>    <select name="cidade">        <option value="0" disabled="disabled">Escolha um Estado Primeiro</option>    </select></label>    <label>        <span>CEP</span>        <input type="text" value="<?php echo $result['cep'];?>" name="cep" id="cep"/>    </label>    <label>        <span>CPF</span>        <input type="text" value="<?php echo $result['cpf'];?>" name="cpf" id="cpf"/>    </label>    <label>        <span>RG</span>        <input type="text" value="<?php echo $result['rg'];?>" name="rg" id="rg"/>    </label>    <label>        <span>Data de emissão RG</span>        <input type="text" value="<?php echo format_data_Normal($result['data_emissao_rg']);?>" name="data_emissao_rg" id="data"/>    </label>    <span>Org&atilde;o Emissor RG</span>    <input type="text" value="<?php echo $result['orgao_emissor_rg'];?>" name="orgao_emissor_rg" id=""/>    <label>        <span>T&iacute;tulo Eleitor</span>        <input type="text" value="<?php echo $result['titulo_eleitor'];?>" name="titulo_eleitor" id=""/>    </label>    <label>        <span>Zona Eleitoral</span>        <input type="text" value="<?php echo $result['zona_eleitoral'];?>" name="zona_eleitoral" id=""/>    </label>    <span>Se&ccedil;&atilde;o Eleitoral</span>    <input type="text" value="<?php echo $result['sessao_eleitoral'];?>" name="sessao_eleitoral" id=""/>    <label>        <span>Tipo Sangu&iacute;neo</span>        <select name="tipo_sanguineo"><?php switch ($result['tipo_sanguineo']){case "a+": echo '<option value="a+" selected="selected">A+</option><option value="a-">A-</option><option value="b+">B+</option><option value="b-">B-</option><option value="ab+">AB+</option><option value="ab-">AB-</option><option value="o+">O+</option><option value="o-">O-</option>';break;case "a-": echo '<option value="a+">A+</option><option value="a-" selected="selected">A-</option><option value="b+">B+</option><option value="b-">B-</option><option value="ab+">AB+</option><option value="ab-">AB-</option><option value="o+">O+</option><option value="o-">O-</option>';break;case "b+": echo '<option value="a+">A+</option><option value="a-">A-</option><option value="b+" selected="selected">B+</option><option value="b-">B-</option><option value="ab+">AB+</option><option value="ab-">AB-</option><option value="o+">O+</option><option value="o-">O-</option>';break;case "b-": echo '<option value="a+" >A+</option><option value="a-">A-</option><option value="b+">B+</option><option value="b-" selected="selected">B-</option><option value="ab+">AB+</option><option value="ab-">AB-</option><option value="o+">O+</option><option value="o-">O-</option>';break;case "ab+": echo '<option value="a+" >A+</option><option value="a-">A-</option><option value="b+">B+</option><option value="b-">B-</option><option value="ab+" selected="selected">AB+</option><option value="ab-">AB-</option><option value="o+">O+</option><option value="o-">O-</option>';break;case "ab-": echo '<option value="a+">A+</option><option value="a-">A-</option><option value="b+">B+</option><option value="b-">B-</option><option value="ab+">AB+</option><option value="ab-" selected="selected">AB-</option><option value="o+">O+</option><option value="o-">O-</option>';break;case "o+": echo '<option value="a+">A+</option><option value="a-">A-</option><option value="b+">B+</option><option value="b-">B-</option><option value="ab+">AB+</option><option value="ab-">AB-</option><option value="o+" selected="selected">O+</option><option value="o-">O-</option>';break;case "o-": echo '<option value="a+">A+</option><option value="a-">A-</option><option value="b+">B+</option><option value="b-">B-</option><option value="ab+">AB+</option><option value="ab-">AB-</option><option value="o+">O+</option><option value="o-" selected="selected">O-</option>';break;}?>    </select><label>    <span>Cor</span>    <input type="text" value="<?php echo $result['cor'];?>" name="cor"/></label>    <span>Escolaridade</span>    <select name="escolaridade"><?php switch($result['escolaridade']){case "analfabeto": echo '<option value="analfabeto" selected="selected">Analfabeto</option><option value="Fundamental Completo">Fundamental Completo</option><option value="Fundamental Incompleto">Fundamental Incompleto</option><option value="Médio completo">M&eacute;dio Completo</option><option value="Médio Incompleto">M&eacute;dio Incompleto</option><option value="Superior">Superior</option><option value="Superior incompleto">Superior Incompleto</option>';break;case "Fundamental Completo": echo '<option value="analfabeto">Analfabeto</option><option value="Fundamental Completo" selected="selected">Fundamental Completo</option><option value="Fundamental Incompleto">Fundamental Incompleto</option><option value="Médio completo">M&eacute;dio Completo</option><option value="Médio Incompleto">M&eacute;dio Incompleto</option><option value="Superior">Superior</option><option value="Superior incompleto">Superior Incompleto</option>';break;case "Fundamental Incompleto": echo '<option value="analfabeto">Analfabeto</option><option value="Fundamental Completo">Fundamental Completo</option><option value="Fundamental Incompleto" selected="selected">Fundamental Incompleto</option><option value="Médio completo">M&eacute;dio Completo</option><option value="Médio Incompleto">M&eacute;dio Incompleto</option><option value="Superior">Superior</option><option value="Superior incompleto">Superior Incompleto</option>';break;case "Médio completo": echo '<option value="analfabeto">Analfabeto</option><option value="Fundamental Completo">Fundamental Completo</option><option value="Fundamental Incompleto">Fundamental Incompleto</option><option value="Médio completo" selected="selected">M&eacute;dio Completo</option><option value="Médio Incompleto">M&eacute;dio Incompleto</option><option value="Superior">Superior</option><option value="Superior incompleto">Superior Incompleto</option>';break;case "Médio Incompleto": echo '<option value="analfabeto">Analfabeto</option><option value="Fundamental Completo">Fundamental Completo</option><option value="Fundamental Incompleto">Fundamental Incompleto</option><option value="Médio completo">M&eacute;dio Completo</option><option value="Médio Incompleto" selected="selected">M&eacute;dio Incompleto</option><option value="Superior">Superior</option><option value="Superior incompleto">Superior Incompleto</option>';break;case "Superior": echo '<option value="analfabeto">Analfabeto</option><option value="Fundamental Completo">Fundamental Completo</option><option value="Fundamental Incompleto">Fundamental Incompleto</option><option value="Médio completo">M&eacute;dio Completo</option><option value="Médio Incompleto">M&eacute;dio Incompleto</option><option value="Superior" selected="selected">Superior</option><option value="Superior incompleto">Superior Incompleto</option>';break;case "Superior incompleto": echo '<option value="analfabeto">Analfabeto</option><option value="Fundamental Completo">Fundamental Completo</option><option value="Fundamental Incompleto">Fundamental Incompleto</option><option value="Médio completo">M&eacute;dio Completo</option><option value="Médio Incompleto">M&eacute;dio Incompleto</option><option value="Superior">Superior</option><option value="Superior incompleto" selected="selected">Superior Incompleto</option>';break;}?>   </select><label>    <span>Profiss&atilde;o</span>    <input type="text" value="<?php echo $result['profissao'];?>" name="profissao"/></label><label>    <span>Empresa onde trabalha</span>    <input type="text" value="<?php echo $result['empresa'];?>" name="empresa"/></label><label>    <span>Telefone da empresa</span>    <input type="text" value="<?php echo $result['telempresa'];?>" name="telempresa" id="tel"/></label></div><div id="igreja"><h4>Dados Eclesiásticos</h4><span>Tipo de Admissão</span>    <input type="text" value="<?php echo $result['admissao'];?>" name="admissao"/><span>Data de Admissão</span>   <input type="text" value="<?php echo format_data_Normal($result['dataAdmissao']);?>" name="dataAdmissao" id="data" value=""/><span>Data de batismo</span>    <input type="text" name="batismo" class="data" value="<?php echo format_data_Normal($result['batismo']);?>"/><span>&Eacute;evang&eacute;lico?</span><?php if($result['evangelico']==1){echo '<input type="radio" checked="checked" name="evangelico" value="1"/>Sim<input type="radio" name="evangelico" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="evangelico" value="1"/>Sim<input type="radio" name="evangelico" value="0" checked="checked"/>N&atilde;o';}?>    <span>&Eacute;Discupulado?</span><?php if($result['discipulo']==1){echo '<input type="radio" checked="checked" name="discipulado" value="1"/>Sim<input type="radio" name="discipulado" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="discipulado" value="1"/>Sim<input type="radio" name="discipulado" value="0" checked="checked"/>N&atilde;o';}?>    <span>&Eacute;Batizado nas &Aacute;guas?</span><?php if($result['aguas']==1){echo '<input type="radio" checked="checked" name="aguas" value="1"/>Sim<input type="radio" name="aguas" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="aguas" value="1"/>Sim<input type="radio" name="aguas" checked="checked" value="0"/>N&atilde;o';}?>    <span>&Eacute;Batizado nas Com o Esp&iacute;rito Santo?</span><?php if($result['es']==1){echo '<input type="radio" checked="checked" name="es" value="1"/>Sim<input type="radio" name="es" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="es" value="1"/>Sim<input type="radio" name="es" checked="checked" value="0"/>N&atilde;o';}?>    <span>&Eacute;Dizimista Fiel?</span><?php if($result['dizimista']==1){echo ' <input type="radio" checked="checked" name="dizimista" value="1"/>Sim<input type="radio" name="dizimista" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="dizimista" value="1"/>Sim<input type="radio" name="dizimista" value="0" checked="checked"/>N&atilde;o';}?>    <span>Tem curso teol&oacute;gico?</span><?php if($result['curso']==1){echo '<input type="radio" checked="checked" name="curso" value="1"/>Sim <input type="radio" name="curso" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="curso" value="1"/>Sim<input type="radio" name="curso" checked="checked" value="0"/>N&atilde;o';}?>    <span>&Eacute;Obreiro?</span><?php if($result['obreiro']==1){echo '<input type="radio" checked="checked" name="obreiro" value="1"/>Sim<input type="radio" name="obreiro" value="0"/>N&atilde;o';}else{echo'<input type="radio" name="obreiro" value="1"/>Sim<input type="radio" name="obreiro" value="0" checked="checked"/>N&atilde;o';}?>    <span>Cargo Eclesiastico</span>    <select name="cargoEclesiastico">        <option value="" selected="selected">Selecione o cargo</option><?php $sq=mysql_query("SELECT * from cargos");while($res=mysql_fetch_array($sq)){if($result['cargoEclesiastico']==$res['id']){echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';}else{echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';}}?>   </select>    <label>        <span>Congrega&ccedil;&atilde;o</span>       <select name="congregacao">            <option value="" selected="selected">Selecione a congregacao</option><?php $sq2=mysql_query("SELECT * from congregacao ORDER BY nome ASC");while($res=mysql_fetch_array($sq2)){if($result['congregacao']==$res['id']){echo '            <option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';}else{echo '            <option value="'.$res['id'].'">'.$res['nome'].'</option>';}}?>        </select>    </label>    <label>        <span>Fun&ccedil;&atilde;o que Exerce</span>        <select name="funcao">            <option value="" selected="selected">Selecione o cargo</option><?php $sq3=mysql_query("SELECT * from cargos");while($res=mysql_fetch_array($sq3)){if($result['funcao']==$res['id']){echo '<option value="'.$res['id'].'" selected="selected">'.$res['nome'].'</option>';}else{echo '<option value="'.$res['id'].'">'.$res['nome'].'</option>';}}?>       </select>    </label></div></fieldset></form>    <?php    ?></div><?php include("menu.php");?><div style="clear: both"></div></div><div id="footer" style="float:right;"><a href="contact.php">feito por: MGS</a></div></div></body></html>